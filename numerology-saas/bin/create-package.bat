@echo off
setlocal

set "APP_ROOT=%~dp0.."
set "DIST_DIR=%APP_ROOT%\dist"
set "PACKAGE_NAME=numerology-saas-local"
set "PACKAGE_DIR=%DIST_DIR%\%PACKAGE_NAME%"
set "ZIP_FILE=%DIST_DIR%\%PACKAGE_NAME%.zip"

if exist "%PACKAGE_DIR%" rmdir /s /q "%PACKAGE_DIR%"
if exist "%ZIP_FILE%" del /q "%ZIP_FILE%"
mkdir "%PACKAGE_DIR%"

robocopy "%APP_ROOT%" "%PACKAGE_DIR%" /E /XD "%APP_ROOT%\dist" "%APP_ROOT%\storage" "%APP_ROOT%\vendor" "%APP_ROOT%\react\node_modules" "%APP_ROOT%\react\dist" >nul
if errorlevel 8 (
  echo Failed to stage package files.
  exit /b 1
)

> "%PACKAGE_DIR%\START-HERE.txt" echo Numerology SaaS Local Package
>> "%PACKAGE_DIR%\START-HERE.txt" echo =============================
>> "%PACKAGE_DIR%\START-HERE.txt" echo.
>> "%PACKAGE_DIR%\START-HERE.txt" echo Windows: double-click Start-NumerologySaaS.bat or bin\install-windows.bat, then open http://127.0.0.1:8000
>> "%PACKAGE_DIR%\START-HERE.txt" echo macOS/Linux: run ./Start-NumerologySaaS.sh or ./bin/install-macos-linux.sh, then open http://127.0.0.1:8000
>> "%PACKAGE_DIR%\START-HERE.txt" echo Default admin: admin@example.com / password123
>> "%PACKAGE_DIR%\START-HERE.txt" echo Requirement: PHP 8.1+ with SQLite extensions enabled.

powershell -NoProfile -ExecutionPolicy Bypass -Command "Compress-Archive -Path '%PACKAGE_DIR%' -DestinationPath '%ZIP_FILE%' -Force"

echo Created package: %ZIP_FILE%
echo Send this ZIP to your local PC, extract it, and open START-HERE.txt.
