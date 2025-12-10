<h1>Register</h1>

<div class="form-card">
    <form method="POST" action="/register">
        <div class="form-group">
            <label>First Name</label><br>
            <input type="text" name="first_name" required>
        </div>

        <div class="form-group">
            <label>Last Name</label><br>
            <input type="text" name="last_name" required>
        </div>

        <div class="form-group">
            <label>Email</label><br>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Password</label><br>
            <input type="password" name="password" required>
        </div>

        <div class="form-group">
            <label>Confirm Password</label><br>
            <input type="password" name="confirm_password" required>
        </div>

        <div class="form-group">
            <label>Account Type</label><br>
            <select name="role" required>
                <option value="organizer">Event Organizer</option>
                <option value="goer">Event Goer</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit">Create Account</button>
        </div>
    </form>
</div>

<br><br>

<a href="/" class="btn-secondary">← Back to Home</a>