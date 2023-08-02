### 1. Site administrator sends an invitation:
- ssh to server
```bash
cd /var/www/<domain_name>
php artisan invitation:send <email_of_the_receiver>
# Successfully send one invitation.
```

### 2. User opens the e-mail, clicks to the register link
As we are testing this in a local environment, using mailtrap makes it easier.
Check your malitrap account.
- Open the e-mail.
- Click the register link

### 3. User fills the registration form
Fill the registration form, and submit.

### 4. Server recieves the form
Server recieves the form data, and sends a verification e-mail the user's e-mail.

### 5. User verifies e-mail
- Check mailtrap
- Open e-mail, click to verify the e-mail
- User is redirected to the user profile page.
- At this stage user is registered to the blog. 
  - Site administrator must add the user to roles to make it functional.

