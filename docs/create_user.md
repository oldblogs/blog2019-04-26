### 1. Site administrator sends an invitation:
- ssh to server
```bash
cd /var/www/<domain_name>
php artisan invitation:send <email_of_the_receiver>
# Successfully send one invitation.
```

[Screenshot](images/registration_01_send_invitation.md)

### 2. User opens the e-mail, clicks to the register link
As we are testing this in a local environment, using mailtrap makes it easier.
Check your mailtrap account.
- Open the e-mail.
- Click the register link

[Screenshot](images/registration_02_read_email.md)

### 3. User fills the registration form
Fill the registration form, and submit.

[Screenshot](images/registration_03_register.md)

### 4. Server recieves the form
Server recieves the form data, and sends a verification e-mail the user's e-mail.

[Screenshot](images/registration_04_check_mail.md)


### 5. User verifies e-mail
- Check mailtrap
- Open e-mail, click to verify the e-mail

[Screenshot](images/registration_05_verify.md)

### 6. Redirect user
- Server accepts verification, redirects user to profile page.
- User is redirected to the user profile page.
- At this stage user is registered to the blog. 
  - Site administrator must add the user to roles to make it functional.

[Screenshot](images/registration_06_redirect.md)

