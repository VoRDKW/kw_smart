<html>
    <head>
        <title>Upload Form</title>
    </head>
    <body>
        <pre>
            <?php print_r($error); ?>
        </pre>

        <?php echo form_open_multipart(base_url('login/upload_image2')); ?>

        <input type="file" name="userfile[]" multiple size="20" />

        <br /><br />

        <input type="submit" value="upload" name="upload" />

    </form>

</body>
</html>

