@echo off
:: Konfigurasi URL CCTV dan direktori penyimpanan
set CCTV_URL=http://username:password@192.168.0.100/snapshot.jpg
set SAVE_DIR=C:\xampp\htdocs\OnlineSystemAttendance\snapshots

:: Membuat direktori jika belum ada
if not exist "%SAVE_DIR%" (
    mkdir "%SAVE_DIR%"
)

:: Membuat nama file berdasarkan waktu saat ini
for /f "tokens=2 delims==" %%I in ('wmic os get localdatetime /value ^| find "="') do set datetime=%%I
set yyyy=%datetime:~0,4%
set mm=%datetime:~4,2%
set dd=%datetime:~6,2%
set hh=%datetime:~8,2%
set mi=%datetime:~10,2%
set ss=%datetime:~12,2%
set filename=snapshot_%yyyy%-%mm%-%dd%_%hh%-%mi%-%ss%.jpg

:: Mengunduh snapshot dari CCTV
curl -o "%SAVE_DIR%\%filename%" %CCTV_URL%

:: Menampilkan hasil
if exist "%SAVE_DIR%\%filename%" (
    echo Snapshot berhasil disimpan: %SAVE_DIR%\%filename%
) else (
    echo Gagal mengambil snapshot dari CCTV.
)

:: Memberikan jeda waktu jika diperlukan
timeout /t 1 >nul
