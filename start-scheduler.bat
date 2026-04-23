@echo off
set PHP_PATH=C:\laragon\bin\php\php-8.4.16-nts-Win32-vs17-x64\php.exe
set PROJECT_PATH=%~dp0
echo Menjalankan Laravel Scheduler...
:loop
"%PHP_PATH%" "%PROJECT_PATH%artisan" schedule:run
timeout /t 60 /nobreak
goto loop
