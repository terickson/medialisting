medialisting
============

This distro shows movie and book information for internal collections.  It also has integrations into google.

Feel free to use it. You will need to setup a php class right outside of the medialisting directory called mlConfig.php.  It should look like this:

<?php
Class mlConfig
{
	public static $myGoogleKey = <<Your Google Key>>;
	public static $movieLocation = <<The location of your movies>>;
	public static $ebookLocation = <<The location of your ebooks>>;
	public static $tarFileDir = <<The tar file temp location for your downloaded material ex: /tmp/>>;
	public static $musicLocation = <<The location of your music>>;
}
?>