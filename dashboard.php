<?php
namespace Phppot;


if (! empty($_SESSION["name"])) {

    require_once './Member.php';

    $member = new Member();
   
    $memberResult = $member->getMemberByName($_SESSION["name"]);
    
    // print_r($memberResult);   
    if(!empty($memberResult[0]["name"])) {
        $displayName = ucwords($memberResult[0]["name"]);
    } else {
        $displayName = $memberResult[0]["name"];
    }

    require_once './DataSource.php';
    $ds = new DataSource();
    $dataResult = $ds->selectUsingQuery("select * from form_element order by id desc");
    
    $i=1;
?>
    
<html>
<head>
<title>User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <link rel="stylesheet" href="contactusform.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body class="dashboard">
    <div>
        <div class="dashboard">
            <div class="member-dashboard">Welcome <b><?php echo $_SESSION["name"]; ?></b>, You have successfully logged in! 
                Click to <a class="btn btn-primary" href="./logout.php" class="logout-button">Logout</a>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Message</th>
                  <th scope="col">Subscribe</th>
                  <th scope="col">Date/time</th>
                </tr>
              </thead>
              <tbody>
                 <?php
                 foreach ($dataResult as $data) {
                 ?>
                <tr>
                  <th scope="row"><?php echo $i++; ?></th>
                  <td><?php echo $data['name']; ?></td>
                  <td><?php echo $data['email']; ?></td>
                  <td><?php echo $data['message']; ?></td>
                  <td><?php echo $data['subscribe']; ?></td>
                  <td><?php echo $data['time']; ?></td>
                </tr>
                <tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php    
}else
{
    session_start();
    $_SESSION["name"] = "";
    session_destroy();
    header("Location: index.php");

}
?>