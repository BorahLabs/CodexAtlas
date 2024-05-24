---
name: Adding a Bitbucket repository
---

# Adding a Bitbucket repository

## Connecting your Bitbucket account

Once your project is setup, you need to connect an account. If you work on Bitbucket, this is done by adding a Bitbucket `App password` to your Codex team. This is **not** the password of your account.

To do it, access your first project and click on *Add Bitbucket account*. This will show you two inputs: `Username` and `App token`. The `Username` field is your Bitbucket username, and the `App token` needs to be generated from Bitbucket.

![Adding a Bitbucket account](/guides/adding-bitbucket-account.png)

To do it, go to your Bitbucket account settings, click on `App passwords` and generate a new token. You can also access directly from [here](https://bitbucket.org/account/settings/app-passwords/).

Make sure to **grant access to the following scopes**:

- `Account`: Read
- `Repositories`: Read
- `Webhooks`: Read and write

![Page to create a token in Bitbucket](/guides/bitbucket-token.png)

Once you have the token, paste it in the `App token` field and click on `Add account`.

## Adding a Bitbucket repository

Bitbucket only allows us to access your own repositories. When adding a repository, select the account that owns that repository and write the full repository name.

![Adding a Bitbucket repository](/guides/adding-bitbucket-repository.png)

Next: [Managing branches](managing-branches)
