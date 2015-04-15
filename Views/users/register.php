<form action="" method="POST">
    <table border="1">
        <tr>
            <td>Username</td>
            <td>
                <input type="text"
                       name="username" />
            </td>
        </tr>
        <tr>
            <td>Password</td>
            <td>
                <input type="password"
                       name="password" />
            </td>
        </tr>
        <tr>
            <td>Action</td>
            <td>
                <input type="submit"
                       name="register"
                       value="Register!"
                    />
            </td>
        </tr>
        <?php if($this->error): ?>
            <tr>
                <td>Error</td>
                <td>
                    <font color="red">
                        <?= $this->error; ?>
                    </font>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</form>
