<h2><?php echo $dress->name; ?></h2>

<img src="/_includes/images/<?php echo $dress->image_url; ?>" />
<p><?php echo $dress->description; ?>"</p>

<p><a href="http://www.facebook.com/sharer.php?u=<?php echo current_url(); ?>&t=<?php echo $dress->name; ?>" target="blank">Share on Facebook</a></p>

<?php if($logged_in): ?>
<p><a href="/dress/star/<?php echo $dress->id; ?>">Add to Favourites</p>
<?php endif; ?>