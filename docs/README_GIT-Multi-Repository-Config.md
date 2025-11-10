# GIT: Multi-Repository On Same Server Configuration

How to set up multiple git repositories on the same server with varied SSH Keys


# SSH Configuration for Multiple GitHub Repositories

This guide explains how to set up an `.ssh/config` file to manage multiple SSH keys for different GitHub repositories. This is useful when you need to deploy code from multiple repositories to the same server or have different SSH keys for different repositories.

## Step 1: Create or Edit the `.ssh/config` File

Create or open the `.ssh/config` file in your home directory:

```bash
# nano ~/.ssh/config

    Host github.com-opuzen-opms
      HostName github.com
      User git
      IdentityFile /home/ubuntu/.ssh/id_ed25519
      IdentitiesOnly yes
    
    Host github.com-opuzen-website
      HostName github.com
      User git
      IdentityFile /home/ubuntu/.ssh/id_ed25519-website
      IdentitiesOnly yes
```

 - _Host:_ A nickname for the SSH host. This can be any unique name.
 - _HostName:_ The actual hostname of the server (github.com).
 - _User:_ The SSH user to connect as (git for GitHub).
 - _IdentityFile:_ The path to the private key file used for this host.
 - _IdentitiesOnly:_ Ensures only the specified IdentityFile is used for authentication.

## Step 2: Set Proper Permissions for SSH Files

```bash
chmod 700 ~/.ssh                    # Correct permissions for the .ssh directory
chmod 600 ~/.ssh/id_ed25519         # Correct permissions for the private key
chmod 644 ~/.ssh/id_ed25519.pub     # Correct permissions for the public key
chmod 600 ~/.ssh/id_ed25519-website # Correct permissions for the second private key
chmod 644 ~/.ssh/id_ed25519-website.pub # Correct permissions for the second public key
chmod 600 ~/.ssh/config             # Correct permissions for the SSH config file
```

## Step 3: Update the Remote URL for Each Git Repository

Navigate to the local repository directory and update the remote URL to use the alias defined in the .ssh/config.

#### For the opuzen-opms repository:

```bash
git remote set-url origin git@github.com-opuzen-opms:PaulKLeasure/opuzen-opms.git
```

#### For the opuzen-website repository:

```bash
git remote set-url origin git@github.com-opuzen-website:PaulKLeasure/opuzen-website.git
```

## Step 4: Verify the Remote Configuration

Ensure that the remote URL is correctly set by running:

```bash
git remote -v 
```

You should see something like:

```bash
origin  git@github.com-opuzen-opms:PaulKLeasure/opuzen-opms.git (fetch)
origin  git@github.com-opuzen-opms:PaulKLeasure/opuzen-opms.git (push) 
```

## Step 5: Test SSH Connection

Test the SSH connection to ensure it’s working properly with the alias:
```bash
ssh -T github.com-opuzen-opms
```

## Step 6: Use git fetch with the Updated Configuration

With the correct alias set in your .ssh/config, you can now run git fetch or other Git commands normally:

```bash
git fetch origin deployDev
```

This will use the correct SSH key specified in the .ssh/config file for each repository.
