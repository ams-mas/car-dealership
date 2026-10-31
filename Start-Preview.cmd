@echo off
for %%D in ("%~dp0.") do set "DEALERSHIP_FOLDER=%%~nxD"
start "" "http://localhost/%DEALERSHIP_FOLDER%/public/"
