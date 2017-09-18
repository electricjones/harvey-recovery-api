# Changelog

All Notable changes to `harvey-recovery-api` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## NEXT - YYYY-MM-DD

### Added
- Laradock container for local dev enviroment
- Initial readme, contributing, etc

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- Nothing

### Security
- Nothing


## v0.7-alpha - 2017-09-15

Initial release.

- Accepts survey from Qualtrics
- Parses Survey response
- Saves survey to mysql
- Saves user (by mobile number) to mysql
- Imports answers from google sheet
- Parses answers from google sheet into `content.en.json`
- Delivers personalized dashboard from survey responses and saved answers
