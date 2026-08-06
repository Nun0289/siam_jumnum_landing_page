param(
    [string]$FtpHost = $env:FTP_HOST,
    [string]$FtpUser = $env:FTP_USER,
    [string]$FtpPassword = $env:FTP_PASSWORD,
    [string]$DeployToken = $env:DEPLOY_TOKEN,
    [string]$WebRoot = "public_html/saimjumnum.charoencodegroup.com",
    [string]$SiteUrl = "https://saimjumnum.charoencodegroup.com"
)

$ErrorActionPreference = "Stop"
$Root = Split-Path -Parent (Split-Path -Parent $MyInvocation.MyCommand.Path)

if (-not $FtpHost -or -not $FtpUser -or -not $FtpPassword) {
    throw "Set FTP_HOST, FTP_USER, FTP_PASSWORD environment variables."
}
if (-not $DeployToken) {
    throw "Set DEPLOY_TOKEN environment variable (long random string)."
}

Write-Host "Building release.zip..."
$ReleaseDir = Join-Path $Root ".release"
$ZipPath = Join-Path $Root "release.zip"
if (Test-Path $ReleaseDir) { Remove-Item $ReleaseDir -Recurse -Force }
if (Test-Path $ZipPath) { Remove-Item $ZipPath -Force }
New-Item -ItemType Directory -Path $ReleaseDir | Out-Null

$Exclude = @('.git', '.github', '.release', 'router.php', 'release.zip', 'deploy-run.php')
Get-ChildItem -Path $Root -Force | Where-Object {
    $Exclude -notcontains $_.Name
} | ForEach-Object {
    Copy-Item -Path $_.FullName -Destination (Join-Path $ReleaseDir $_.Name) -Recurse -Force
}

Remove-Item (Join-Path $ReleaseDir "config\config.local.php") -ErrorAction SilentlyContinue
Get-ChildItem (Join-Path $ReleaseDir "uploads") -Exclude ".gitkeep" -ErrorAction SilentlyContinue | Remove-Item -Recurse -Force -ErrorAction SilentlyContinue
Copy-Item (Join-Path $Root "deployment\cpanel\.htaccess") (Join-Path $ReleaseDir ".htaccess") -Force

Compress-Archive -Path (Join-Path $ReleaseDir "*") -DestinationPath $ZipPath -Force
Write-Host "Created $ZipPath ($('{0:N2}' -f ((Get-Item $ZipPath).Length / 1MB)) MB)"

Write-Host "Preparing deploy-run.php..."
$DeployRunSrc = Get-Content (Join-Path $Root "deployment\cpanel\deploy-run.php") -Raw
$DeployRun = $DeployRunSrc.Replace('__DEPLOY_TOKEN_PLACEHOLDER__', $DeployToken)
$DeployRunPath = Join-Path $Root "deploy-run.php"
Set-Content -Path $DeployRunPath -Value $DeployRun -NoNewline

function Upload-FtpFile {
    param([string]$LocalPath, [string]$RemotePath)
    $uri = "ftp://${FtpHost}/${RemotePath}"
    $request = [System.Net.FtpWebRequest]::Create($uri)
    $request.Method = [System.Net.WebRequestMethods+Ftp]::UploadFile
    $request.Credentials = New-Object System.Net.NetworkCredential($FtpUser, $FtpPassword)
    $request.UseBinary = $true
    $request.UsePassive = $true
    $request.KeepAlive = $false
    $bytes = [System.IO.File]::ReadAllBytes($LocalPath)
    $request.ContentLength = $bytes.Length
    $stream = $request.GetRequestStream()
    $stream.Write($bytes, 0, $bytes.Length)
    $stream.Close()
    $response = $request.GetResponse()
    Write-Host "Uploaded $RemotePath ($($response.StatusDescription.Trim()))"
    $response.Close()
}

Upload-FtpFile -LocalPath $ZipPath -RemotePath "$WebRoot/release.zip"
Upload-FtpFile -LocalPath $DeployRunPath -RemotePath "$WebRoot/deploy-run.php"

Write-Host "Extracting on server..."
$extractUrl = "$SiteUrl/deploy-run.php"
for ($i = 1; $i -le 5; $i++) {
    try {
        $response = Invoke-WebRequest -Uri $extractUrl -Method POST -Headers @{ "X-Deploy-Token" = $DeployToken } -UseBasicParsing -TimeoutSec 300
        Write-Host $response.Content
        if ($response.Content -match "OK extract complete") {
            Write-Host "Deploy complete: $SiteUrl"
            exit 0
        }
    } catch {
        Write-Host "Attempt $i failed: $($_.Exception.Message)"
    }
    Start-Sleep -Seconds 5
}

throw "Extract failed after 5 attempts."
