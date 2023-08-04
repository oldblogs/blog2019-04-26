## [Back](../INSTALL.md)

## Set a remote directory on Dev PC that connects to VM
```bash
cd ~/projects
mkdir blog2019-04-26
cd blog2019-04-26
mkdir remote
cd remote
nano connect.sh
```

connect.sh
```bash
#!/bin/bash
sshfs -o idmap=user vmuser1@<IP address of VM >:/var/www/<domain_name> /home/<dev_user>/projects/blog2019-04-26/remote
```

Save & exit. 

```bash
nano disconnect.sh
```

disconnect.sh
```bash
#!/bin/bash
fusermount -u /home/<dev_user>/projects/blog2019-04-26/remote/
```

Save & exit. 

Make scripts executable:
```bash
cd ~/projects/blog2019-04-26
chmod u+x connect.sh
chmod u+x disconnect.sh
```

To mount VM directory to Dev PC, Execute on Dev PC:
```bash
cd ~/projects/blog2019-04-26
./connect.sh
```

Now /var/www/<domain_name> directory is mounted to /home/<dev_user>/projects/blog2019-04-26/remote

To unmount the directory, Execute on Dev PC:
```bash
cd ~/projects/blog2019-04-26
./disconnect.sh
```