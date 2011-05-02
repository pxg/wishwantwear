<p>Look at our beautiful dresses</p>

<?php foreach($dresses as $key => $dress): ?>
	<h2><?php echo $dress->name; ?></h2>
	
	<a href="/dress/view/<?php echo $dress->id; ?>">
	<img src="/_includes/images/<?php echo $dress->image_url; ?>" />
	</a>
	
	<p>£<?php echo $dress->price; ?></p>
<?php endforeach; ?>