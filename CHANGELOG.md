## [Unreleased]

## [1.0.2] - 2018-05-03
### Bug Fixes
- check instantinability of task classes in stricter way
- exclude directories when finding task classes

### Chores
- **git-chglog:** exclude .chglog directory from git exporting

### Documentation
- write changelog for v1.0.1

### Testing
- add a test case that glob function returns false in TaskClassesConformingToPsr4 when error occ

## [1.0.1] - 2018-05-01
### Bug Fixes
- omit abstract classes from task class candidates

### Chores
- **git-chglog:** add commit message type `docs`

### Documentation
- write changelog for v1.0.0

## 1.0.0 - 2018-04-30
### Chores
- specify git-chglog commit message setting
- add git-chglog to manage changelog
- remove php-nightly(7.3) from CI testing

### Features
- add the first implementation

[Unreleased]: https://github.com/suin/cakephp-subcommand-injector/compare/1.0.2...HEAD
[1.0.2]: https://github.com/suin/cakephp-subcommand-injector/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/suin/cakephp-subcommand-injector/compare/1.0.0...1.0.1
