# ASW Membership Roster Developer Notes

## Overview
The **ASW Membership Roster** Version 2 uses the **Larvel 8.x** framework. It is designed to run on an **Amazon EC2** instance which can be fully provisioned with included **Ansible** playbooks via the `provision.sh` and `deploy.sh` bash scripts. 

## EC2 Setup
Assuming you will be using **Amazon EC2**, it will be necessary to expose the `HTTP`, `HTTPS`, and `SSH` ports in the **Security Group** associated with your instance.
 
## Vagrant Setup
The default development environment is **Vagrant** (https://www.vagrantup.com/docs/installation)

You will need to add any SSH private keys needed to access your remote boxes to the `~/.ssh` directory on the **Vagrant** instance, as these will be referenced by the **Ansible** `hosts` inventory files.
## Ansible Setup
Once you have the **Vagrant** environment set up, `ssh` to the vagrant box (`vagrant ssh`) and install **Ansible** (https://docs.ansible.com/ansible/latest/installation_guide/intro_installation.html)

This setup also requires the `community.general.composer` plugin. To install it use: 

`$ ansible-galaxy collection install community.general`

The `ansible/hosts` directory should contain inventory files for every environment you need (usually `development`, `staging`, and `production`). For remote boxes, you will need to point to the private key:

```
[production]
 1.1.1.1 ansible_ssh_private_key_file=/home/vagrant/.ssh/production.pem
```
...where `1.1.1.1` refers to the actual IP address of your remote instance.

## Nginx Configuration
The default Nginx server configuration will be found in the `ansible/templates/roster.conf` file.  During provisioning, this file is copied to the `/etc/nginx/sites-available` directory, and a symlink is created from this.  By default, it is named `roster.org`. If you wish to change the name, you'll need to edit `ansible/nginx.yml`. 

**NOTE**: As of this writing, the HTTPS settings have not been implemented.

## Provisioning 
Provisioning is handled by the `build.sh` script in the project root.  It has two required arguments -- the action (`provision` or `deploy`) and the environment (`production` or `staging`). It can take any valid `ansible-playbook` options (e.g., `-v` for "verbose"). Example syntax:

- `$ ./build.sh provision production` 
- `$ ./build.sh provision staging` 
- `$ ./build.sh provision staging -v`

You will need to create a `.env` file to be used on your remote instances.  This should contain all of the secret keys need (e.g., database user and password).  To encrypt the file via Ansible, use the following method:

1. In the project root, create what will become your production `.env` file and name it `production.env`.
2. Copy `production.env` to `prodenv.v`.
3. Encrypt it using `ansible-vault encrypt prodenv.v`
4. Enter a Vault password.
5. Create a file in the `ansible` directory called `vpwd` and save the password in it.

**NOTES**: 
- Make sure that `production.env`, `prodenv.v`, and `ansible/vpwd` are listed in `.gitignore`. 
- Any time you need to make a change to the production `.env`, you must change `production.env` and re-copy to `prodenv.v` before encrypting.

## Deploying Updates
When you need to deploy changes to the code, you will also use the `build.sh` script. The deploy process does the following:
- Pull the latest commit to the `master` branch of the repo.
- Run `composer install`.
- Run `php artisan migrate`.
- Uploads and decrypts the production `.env` file.

Examples:

- `$ ./build.sh deploy production` 
- `$ ./build.sh deploy staging` 
- `$ ./build.sh deploy staging -v`

