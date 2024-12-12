<!-- resources/views/emails/invitation.blade.php -->

<p>Dear,</p>

<p>You are invited to join our research group website as a member of the group to showcase your work & bio.</p>

<p>To complete your registration, please use the following one-time invitation code:</p>

<p><strong>User ID:</strong> {{ $mailData['email'] }}</p>
<p><strong>Invitation Code:</strong> <span style="color:red;">{{ $mailData['code'] }}</span></p>

<p>To redeem this invitation code:</p>

<ol>
    <li>Go to [registration url]</li>
    <li>Enter the invitation code</li>
    <li>Enter your name and email address</li>
    <li>Create a password</li>
    <li>Click "Register" to complete setup</li>
</ol>

<p>Once registered, you will be able to update your profile and write posts for our group website.</p>

<p>Let me know if you have any trouble with the registration process!</p>

<p>Best regards,</p>
<p><strong>Dr John Buckeridge</strong></br>
    <strong>Senior Lecturer</strong></br>
    T703, Mechanical Engineering - School of Engineering</br>
    London South Bank University,</br>
    103 Borough Road, London SE1 0AA</br>
    Tel.: +44 (0)20 7815 7420</br>
    Email: <a href="mailto:j.buckeridge@lsbu.ac.uk">j.buckeridge@lsbu.ac.uk</a></br>
    Website: <a href="https://jbuckeridge.github.io/">jbuckeridge.github.io</a>
</p>
