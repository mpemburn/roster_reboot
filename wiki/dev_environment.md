# ASW Membership Roster Developer Notes

## Overview
The **ASW Membership Roster** Version 2 uses a **Larvel 8.x** framework. It is designed to run on an **Amazon EC2** instance which can be fully provisioned with included **Ansible** playbooks via the `provision.sh` and `deploy.sh` bash scripts. 

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
Provisioning is handled by `provision.sh` script in the project root.  It has one required argument -- the environment -- and can take any valid `ansible-playbook` options. Example syntax:

- `$ ./provision.sh production` 
- `$ ./provision.sh staging` 
- `$ ./provision.sh staging -v`

You will need to create a `.env` file to be used on your remote instances.  This should contain all of the secret keys need (e.g., database user and password).  To encrypt the file via Ansible, use the following method:

- In the project root, create your production `.env` file and name it `prodenv.v`
- Encrypt it using `ansible-vault --encrypt prodenv.v`
- Enter a Vault password.
- Create a file in the `ansible` directory called `vpwd` and save the password in it.

**NOTE**: Make sure that both `prodenv.v` and `ansible/vpwd` are listed in `.gitignore`. 

