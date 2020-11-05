##Overview
The ASW Roster Version 2 uses a Larvel 8.x framework. It is designed to run on an Amazon EC2 instance which can be fully provisions with included Ansible playbooks via the `provision.sh` and `deploy.sh` bash scripts. 

##EC2 Setup
Assuming you will be using Amazon EC2, it will be necessary to expose the `HTTP`, `HTTPS`, and `SSH` ports in the Security Group associated with your instance.
 
##Vagrant Setup
The default development environment is Vagrant (https://www.vagrantup.com/docs/installation)

You will need to add any SSH private keys needed to access your remote boxes to the `~/.ssh` directory on the Vagrant instance, as these will be referenced by the Ansible `hosts` inventory files.
##Ansible Setup
Once you have the Vagrant environment set up, `ssh` to the vagrant box and install Ansible (https://docs.ansible.com/ansible/latest/installation_guide/intro_installation.html)

This setup also requires the `community.general.composer` plugin. To install it use: 

`$ ansible-galaxy collection install community.general`

The `ansible/hosts` directory should contain inventory files for every environment you need (usually `development`, `staging`, and `production`). For remote boxes, you will need to point to the point to the private key:

```
[production]
 1.1.1.1 ansible_ssh_private_key_file=/home/vagrant/.ssh/production.pem
```
...where `1.1.1.1` refers to the actual IP address of your remote instance.

##Provisioning 
Provisioning is handled by `provision.sh` script in the project root.  It has one required argument -- the environment -- and can take any valid `ansible-playbook` options. Example syntax:

- `$ ./provision.sh production` 
- `$ ./provision.sh staging` 
- `$ ./provision.sh staging -v`

There is at least one Ansible Vault encrypted file (the .env file) that requires a password and this should be stored in a file in the `ansible` directory called `vpwd`.  This file is `git` ignored.
