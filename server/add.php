<?php include("header.php"); ?>

<?php
//require_once 'login.php';

$db_hostname = 'localhost';
$db_database = 'example';
$db_username = 'example';
$db_password = 'example';



$db_server = mysql_connect($db_hostname, $db_username, $db_password);
if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
mysql_select_db($db_database, $db_server)
or die("Unable to select database: " . mysql_error());

if (isset($_POST['title']) &&
isset($_POST['newspaper']) &&
isset($_POST['year']) &&
isset ($_POST ['id']))

{
	// id 	favorite 	newspaper 	title 	date 	newscategory 	credits 	source 	url 	thumbnail
	$id = get_post ('id');
	$favorite= (isset($_POST['favorite'])) ? 1 : 0;
	$newspaper = get_post('newspaper');

	$title = get_post('title');
	$day = get_post ('day');
	$month = get_post ('month');
	$year = get_post('year');

	$newscategory = get_post('newscategory');
	$credits = get_post('credits');
	$source = get_post('source');
	$url = get_post ('url');
	$thumbnail = get_post ('thumbnail');
	
	// socialdata 	readergenerated 	opendata 	gamification 	tool 
	
	$socialdata= (isset($_POST['socialdata'])) ? 1 : 0;
	$readergenerated= (isset($_POST['readergenerated'])) ? 1 : 0;
	$opendata= (isset($_POST['opendata'])) ? 1 : 0;
	$gamification= (isset($_POST['gamification'])) ? 1 : 0;
	$tool= (isset($_POST['tool'])) ? 1 : 0;
	$technology = (isset($_POST['technology'])) ? 1 : 0;
	
	// readerdriven 	technology 	visualform 	visualformsub 	updatedmonth updatedday updatedyear 	hyperlinking 	comments
	
	$readerdriven = get_post ('readerdriven');
	$visualizationtype = get_post ('visualizationtype');
	$annotation = get_post ('annotation');
	
	for ($i=0; $i<count($_POST['visualform']); $i++){
	$visualform .= addslashes($_POST['visualform'][$i]) . ", ";
	}
	
	for ($i=0; $i<count($_POST['visualformsub']); $i++){
	$visualformsub .= addslashes($_POST['visualformsub'][$i]) . ", ";
	}

	$updatedmonth = get_post ('updatedmonth');
	$updatedday = get_post ('updatedday');
	$updatedyear = get_post ('updatedyear');
	
	$updated = $updatedyear . $updatedmonth . $updatedday;
	
	$hyperlinking = get_post ('hyperlinking');
	$comments = get_post ('comments');


if (isset($_POST['delete']) && $id != "")
{
	
$query = "DELETE FROM graphics WHERE id='$id'";
if (!mysql_query($query, $db_server))
echo "DELETE failed: $query<br />" .
mysql_error() . "<br /><br />";
}
else
{
	
	$date = $year . $month . $day ;
	
	//// id 	favorite 	newspaper 	title 	date 	newscategory 	credits 	source 	url 	thumbnail
	 
$query = "INSERT INTO graphics VALUES" .
"('$id','$favorite', '$newspaper', '$title', '$date', '$newscategory', '$credits', '$source', '$url', '".$_FILES['thumbnail']['name']."', 
'$socialdata', '$readergenerated', '$opendata', '$gamification', '$tool', 
'$readerdriven', '$visualizationtype', '$annotation', '$technology', '$visualform', '$visualformsub', '$updated', '$hyperlinking', '$comments')";
if (!mysql_query($query, $db_server))
echo "INSERT failed: $query<br />" .
mysql_error() . "<br /><br />";
}
}


if ($_FILES)
{
	$target_path = "";
	
	if ($newspaper == "Ny Times")
	{
		$target_path = "images/nytimes/";
	} else if ($newspaper == "Guardian")
	{
		$target_path = "images/guardian/";
	}
	
	
	$target_path = $target_path . basename( $_FILES['thumbnail']['name']);	
	move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_path);
		
//echo "Uploaded image '$name'<br /><img src='$name' />";
}



echo <<<_END
	<html lang="en">
		<head>

			<meta charset="utf-8" />
			<meta name="description" content="Add a graphic" />
			<title>Add Graphic</title> 

			<link rel="stylesheet" type="text/css" href="css/addGraphic.css" />

		</head>
		<body>

<div class="container">
<div class="content">

<h1> Add Interactive Graphic </h1>

<section>
<h2> 1. Basics </h2>

<form action="addGraphic.php" method="post" enctype='multipart/form-data'><pre>
<input type="hidden" name="id" />

<div class="floatLeft">
<label><input type="checkbox" name="favorite" value="1" /> Favorite </label>

<span class="descrip"> Newspaper</span>
<select name="newspaper" size="1">
<option value="Guardian">Guardian</option>
<option value="Ny Times">NY Times </option>
</select>

<span class="descrip"> Title </span>
<input type="text" name="title" class=”formTitle” size="35"/>

<span class="descrip"> Date <span>
<input type="text" name="month" size="2" placeholder="mm"/> <input type="text" name="day" size="2" placeholder="dd"/> <input type="text" name="year" size="4" placeholder="yyyy"/>

<span class="descrip"> News Category</span>
<select name="newscategory" size="1">
<option value="Economy">Business</option>
<option value="Conflict">Conflict</option>
<option value="Culture">Culture</option>
<option value="Demographics">Demographics</option>
<option value="Disaster">Disaster</option>
<option value="Environment">Environment</option>
<option value="Health">Health</option>
<option value="LifeStyle">Life & Style</option>
<option value="Other">Other</option>
<option value="Politics">Politics</option>
<option value="Science">Science</option>
<option value="Sports">Sports</option>
</select>
</div>


<div class="floatLeft">
<span class="descrip"> Credits</span>
<input type="text" name="credits" class=”formTitle” size="35"/>

<span class="descrip"> Sources </span>
<input type="text" name="source" class=”formTitle” size="35"/>

<span class="descrip"> Url</span>
<input type="text" name="url" size="35" />

<span class="descrip"> Thumbnail (250px * 150px)</span>
<input name="thumbnail" accept="image/jpeg" type="file" size="35" >
</div>

</section>

<section>
<h2> 2. Participation </h2>

<label class="standAlone"><input type="checkbox" name="socialdata" value="1" /> Social Sphere</label>

<label class="standAlone"><input type="checkbox" name="readergenerated" value="1" /> Reader Generated Data</label>

<label class="standAlone"><input type="checkbox" name="opendata" value="1" /> Open Data </label>

<label class="standAlone"><input type="checkbox" name="gamification" value="1" />Gamification </label>

<label class="standAlone"><input type="checkbox" name="tool" value="1" /> Tool </label>

</section>


<section>
<h2> 3. Presentation </h2>

<h3> User- or authordriven (Segel and Heer, 2010)</h3>
<label><input type="radio" name="readerdriven" value="user" /> User </label> | <label><input type="radio" name="readerdriven" value="hybrid" /> Hybrid</label> | <label><input type="radio" name="readerdriven" value="author" /> Author </label>  | <label><input type="radio" name="readerdriven" value="debatable" /> Debatable</label>

<h3> Question</h3>
Should Include the Interactive Dynamics List of Heer and Shneiderman (2012)? 
And include awards won as suggested by Andrew Vande Moere?

<h3> Visualized Type </h3>
<label><input type="radio" name="visualizationtype" value="quantitative" /> Quantitative </label> | <label><input type="radio" name="visualizationtype" value="hybrid" /> Hybrid</label> | <label><input type="radio" name="visualizationtype" value="qualitative" /> qualitative </label> | <label><input type="radio" name="visualizationtype" value="debatable" /> Debatable </label> 

<h3> Annotation </h3>
<label><input type="radio" name="annotation" value="low" check="checked"/> Low </label> | <label><input type="radio" name="annotation" value="high" /> High </label> | <label><input type="radio" name="annotation" value="debatable" /> Debatable</label>

<h3> Visual Elements</h3>
	
	<div class="listStyle">
	<label> <input type="checkbox" name="visualform[]" value="Chart" /> Chart </label>
	<ul>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="area chart" /> Area chart </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="bubble chart" /> Bubble chart </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="bar chart" /> Bar/Column chart </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="pie/donut chart" /> pie/donut chart </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="line chart" /> line chart </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="scatter chart" /> scatter chart </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="chartother" /> Chart other </label> </li>
	</ul>
	</div>
	
	<div class="listStyle">
	<label> <input type="checkbox" name="visualform[]" value="hierarchy" /> Hierarchy </label>	
	<ul>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="treemap" /> Treemap </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="circle packing" /> Circle Packing </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="hierarchyother" /> Hierarchy other </label> </li>
	</ul>
	</div>

	<div class="listStyle">
	<label> <input type="checkbox" name="visualform[]" value="map" /> Map </label>
	<ul>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="choropleth" /> Choropleth Map</label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="dot map" /> Dot Map</label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="cartogram" /> Cartogram </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="symbol map" /> Symbol map </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="mapother" /> Map other </label> </li>
	</ul>
	</div>

	<div class="listStyle">	
	<label><input type="checkbox" name="visualform[]" value="Misch" /> Misch </label>
	<ul>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="before/after" /> Before/After </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="streamgraph" /> Streamgraph </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="simulation" /> Simulation / Walkthrough </label> </li>		
		<li> <label> <input type="checkbox" name="visualformsub[]" value="table" /> Table </label> </li>
		<li> <label> <input type="checkbox" name="visualformsub[]" value="timeline" /> Timeline </label> </li>		
	</ul>
	</div>
	
	<div class="listStyle">
	<label><input type="checkbox" name="visualform[]" value="Textual" /> Textual </label>
	</div>
	
	<div class="listStyle">
	<label><input type="checkbox" name="visualform[]" value="Other" /> Other </label>
	</div>
	
</section>

<section>

	<h2> 4. Misch </h2>
	
	<h3> Comments </h3>
	<textarea name="comments" cols="50" rows="3" wrap="type">
	</textarea>


<h3> Flash</h3>
<label class="standAlone"><input type="checkbox" name="technology" value="1" />Flash </label>

<h3> Updated </h3>
<input type="text" name="updatedmonth" size="2" placeholder="mm"/> <input type="text" name="updatedday" size="2" placeholder="dd"/> <input type="text" name="updatedyear" size="4" placeholder="yyyy"/>

<h3> Hyperlinking within visualization</h3>
<label><input type="radio" name="hyperlinking" value="no" check="checked"/>none</label> | <label><input type="radio" name="hyperlinking" value="internal" /> internal</label> | <label><input type="radio" name="hyperlinking" value="external" /> external</label> | <label><input type="radio" name="hyperlinking" value="combination"/> combination</label>

</section>

<input type="submit" value="ADD RECORD" />


</pre></form>
</div>
</div>

</body>
</html>
_END;


mysql_close($db_server);
function get_post($var)
{
return mysql_real_escape_string($_POST[$var]);
}
?>