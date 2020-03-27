<?php


$db_host='localhost';
$db_name='ajax_exo';
$db_user='root';
$db_password=''; 

try{
    $db = new PDO(
        "mysql:host=$db_host;dbname=$db_name",
        $db_user,
        $db_password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Active les erreurs SQL
            //On récupere tous les resultats en associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

}catch (Exception $e){
    echo $e->getMessage();
    exit();
};


// -------------------------------------------------------


$firstname = $_POST['firstname'] ?? null;
$lastname = $_POST['lastname'] ?? null;



$user = [

   /*  [
        'firstname' => "walid",
        'lastname' => "bilem"
    ],
    [
        'firstname' => "wisam",
        'lastname' => "bilem"
    ], */
];

$i = $db->query('SELECT * FROM users');

foreach($i as $users){

    array_push($user, [
        'lastname' => $users['lastname'],
        'firstname' => $users['firstname'],
    ]);
};

if (isset($_POST['firstname'], $_POST['lastname']))
{

    $query = $db->prepare('INSERT INTO users (`firstname`,`lastname`) VALUES (:firstname , :lastname)');
    $query->bindValue(':firstname', $firstname);
    $query->bindValue(':lastname', $lastname);
    
    $query->execute();

    array_push($user, [
        'lastname' => $lastname,
        'firstname' => $firstname
    ] );
}

header(('content-type: application/json'));
echo json_encode($user);