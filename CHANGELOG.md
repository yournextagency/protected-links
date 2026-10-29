# Protected Links Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## 5.1.0 - 2026-10-29
### Security
- Link codes can no longer be computed from the link params. They were a plain SHA-1 of the params (site ID, asset ID and the link options), so anyone could build a working code for any asset ID without having seen the link. Codes are now an HMAC-SHA256 keyed with Craft's `securityKey`, and generating a link throws if `securityKey` is empty.
- Links issued before 5.1.0 keep working until their codes are rotated. Run `php craft protected-links/links/rotate-legacy-links` after upgrading to replace each legacy code with a random one; links issued before the upgrade then stop working, and templates that call `craft.protectedLinks.link()` issue new links on their next render. Links issued since 5.1.0 are left alone, so the command can run at any time and more than once.

### Added
- `protected-links/links/rotate-legacy-links` console command.

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