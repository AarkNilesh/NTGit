@echo off
setlocal

where php >nul 2>nul
if errorlevel 1 (
  echo PHP is required but was not found in PATH.
  echo Install PHP 8.1 or newer, enable SQLite extensions, then run this installer again.
  pause
  exit /b 1
)

set "SOURCE_DIR=%~dp0.."
set "INSTALL_DIR=%LOCALAPPDATA%\NumerologySaaS"

echo Installing Numerology SaaS to %INSTALL_DIR% ...
if exist "%INSTALL_DIR%" rmdir /s /q "%INSTALL_DIR%"
mkdir "%INSTALL_DIR%"

robocopy "%SOURCE_DIR%" "%INSTALL_DIR%" /E /XD "%SOURCE_DIR%\dist" "%SOURCE_DIR%\storage" "%SOURCE_DIR%\vendor" "%SOURCE_DIR%\react\node_modules" "%SOURCE_DIR%\react\dist" >nul
if errorlevel 8 (
  echo Failed to copy application files.
  pause
  exit /b 1
)

php "%INSTALL_DIR%\bin\setup-local.php"

powershell -NoProfile -ExecutionPolicy Bypass -Command "$WshShell = New-Object -ComObject WScript.Shell; $Shortcut = $WshShell.CreateShortcut([Environment]::GetFolderPath('Desktop') + '\Numerology SaaS.lnk'); $Shortcut.TargetPath = '%INSTALL_DIR%\bin\run-local.bat'; $Shortcut.WorkingDirectory = '%INSTALL_DIR%'; $Shortcut.IconLocation = 'shell32.dll,13'; $Shortcut.Save()"

echo.
echo Installed successfully.
echo Desktop shortcut created: Numerology SaaS
echo Double-click it, then open http://127.0.0.1:8000 in your browser.
pause
