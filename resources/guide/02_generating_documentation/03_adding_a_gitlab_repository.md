---
name: Adding a Gitlab repository
---

# Adding a Gitlab repository

## Connecting your Gitlab account

Once your project is setup, you need to connect an account. If you work on Gitlab, this is done by adding a Gitlab token to your Codex team.

To do it, access your first project and click on *Add Gitlab account*. This will show you two inputs: `Username` and `App token`. The `Username` field is your Gitlab username, and the `App token` needs to be generated from Gitlab.

![Adding a Gitlab account](/guides/adding-gitlab-account.png)

To do it, go to your Gitlab account settings, click on `Access Tokens` and generate a new token with the `api` scope. You can also access directly from [here](https://gitlab.com/-/user_settings/personal_access_tokens).

Make sure to set the **expiration date** to some time in the future (ideally, **a year**), and to **grant access to the `api` scope**.

![Page to create a token in Gitlab](/guides/gitlab-token.png)

Once you have the token, paste it in the `App token` field and click on `Add account`.

## Adding a Gitlab repository

Gitlab only allows us to access repositories that are public or that you own. When adding a repository, select the account that owns that repository and write the full repository name.

![Adding a Gitlab repository](/guides/adding-gitlab-repository.png)

Next: [Adding a Bitbucket repository](adding-a-bitbucket-repository)
