<?php
namespace Statapus;
use \OctoShepherd\Shepherd;
$app = require dirname(__DIR__) . "/src/bootstrap.php";

if( ! $app->app_is_authed())
{
    $auth_state             = Shepherd::generate_state_string();
    $client_id              = $app->get_client_id();
    // place in session so we can recover it after returning from Oauth Service
    $_SESSION['auth_state'] = $auth_state;
    $oauth_url              = Shepherd::auth_request_uri($client_id, $auth_state, array('user', 'repo'));
}
else
{
    $shep  = new Shepherd(array('access_token' => $app->get_access_token()));
    $repos = $shep->get_org_repos_for("ShopIgniter");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Home</title>
</head>
<body>
    <?php
    if($app->app_is_authed())    { ?>
    <h1>Awesome Dashboard!</h1>
        <p>This is a complete work in progress.  At this point just getting basic functionality inplace</p>
        <h2>Found Repos</h2>
        <ul id="all_repos">
        <?php foreach($repos->to_array() as $repo) { ?>
            <li id="<?php h($repo['git_url']); ?>"><?php h($repo['full_name']); ?></li>
        <?php } ?>
        </ul>
        <h2>Dump of a Repo's info</h2>
        <pre>
        <?php print_r(current($repos->to_array())); ?>
        </pre>
    <?php } else { ?>
    <button
            onclick="window.location = '<?php echo $oauth_url; ?>';">Authorize You App</button>
    <?php } ?>
</body>
</html>