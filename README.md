# Hallway Flux

Flux powered front‑end for Hallway.fm. Provides Livewire components and resources for building Hallway user interfaces.

## Archived 2026-11-18

This repository is archived and read-only. Abandoned, with three separate blockers: `hallway-core` is unpublished, `livewire/flux-pro` is private, and `pestphp/pest-plugin-laravel ^2.3` cannot coexist with `roave/security-advisories`.

Its open "Drop PHP 8.4 from CI" pull request (#1) was closed unmerged at the same time. That PR was
not what broke CI here: `orchestra/testbench ^9.x` accepts only `laravel/framework` 11.x, and every
11.x release is now withheld by Composer's security-advisory policy, so `composer install` fails
before a test runs. The full diagnosis of all twenty repos in that sweep is in brain at
`projects/brain/reports/drop-php84-prs-2026-11-10.md`.
