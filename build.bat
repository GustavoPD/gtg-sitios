@echo off
rem Arma los 4 sitios en dist\ (doble clic). Para uno solo: build.bat cl
cd /d "%~dp0"
where php >nul 2>nul && (php build.php %*) || ("C:\xampp\php\php.exe" build.php %*)
pause
