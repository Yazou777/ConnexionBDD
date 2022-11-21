$picture = (isset($_POST['fichier']) && $_POST['fichier'] != "") ? $_POST['fichier'] : Null;  
|| $picture == Null
$artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
|| $artist == Null 

$requete = $db->prepare("UPDATE disc SET disc_title = :titre, disc_year = :year, disc_genre = :genre, disc_label = :label, disc_price = :price, disc.artist_id = :artist WHERE disc_id = :id;"); 
