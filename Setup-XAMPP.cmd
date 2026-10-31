@echo off
setlocal
cd /d "%~dp0"
set "DEALERSHIP_PHP="
for %%X in ("%~d0\xampp\php\php.exe" "C:\xampp\php\php.exe" "E:\xampp\php\php.exe") do if not defined DEALERSHIP_PHP if exist "%%~X" set "DEALERSHIP_PHP=%%~X"
if not defined DEALERSHIP_PHP (
 echo XAMPP PHP not found. Run your-xampp-path\php\php.exe xampp\setup.php manually.
 pause
 exit /b 1
)
"%DEALERSHIP_PHP%" artisan config:clear
if errorlevel 1 goto failed
"%DEALERSHIP_PHP%" xampp/setup.php
if errorlevel 1 goto failed
"%DEALERSHIP_PHP%" artisan view:clear
if errorlevel 1 goto failed
echo Setup complete. See README.md for the URL.
pause
exit /b 0
:failed
echo Setup did not complete. Fix the error above and run this file again.
pause
exit /b 1
