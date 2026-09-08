# Protected Links Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## 5.0.4 - 2026-09-08
### Changed
- Require Craft 5. The 5.0.x line already relies on `Element::EVENT_DEFINE_ATTRIBUTE_HTML` and `craft\events\DefineAttributeHtmlEvent`, which the `^4.0.0` half of the old constraint does not guarantee. Craft 4 installs stay on the 4.0.x line.

### Fixed
- Restore admin access to member- and group-restricted links. The Craft 5 port called `getIsAdmin()` on the identity, which is a `craft\elements\User` element and has no such method, so every restricted download threw an `UnknownMethodException`. The check now goes through the `craft\web\User` component, which also stops it from tripping over a null identity for anonymous requests.

## 4.0 - 2023-08-01
### Changed 
- Craft 4.x compatibility

## 1.0.0 - 2022-11-04
### Added
- CraftCMS ^4.0.0 compatibility.

## 0.0.2 - 2018-09-10
### Changed
- Admins can download files restricted to certain members/groups

## 0.0.1-RC2 - 2018-08-06
### Changed
- Plugin handle fixes

## 0.0.1-RC1 - 2018-04-23
### Added
- Initial release