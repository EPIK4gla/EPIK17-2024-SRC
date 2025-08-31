<?php
session_start();
  
if($_GET['u']) {
  $username = $_GET['u'];
    require_once "Assemblies/Roblox/Grid/Rcc/RCCServiceSoap.php";
    $RCCServiceSoap = new RCCServiceSoap();
    $charAppUrl = 'http://eb2.ct8.pl/Avatars/' . $username . '.txt';

    $avatarUrl = "http://eb2.ct8.pl/Avatars/{$username}.txt";
$defaultUrl = "http://eb2.ct8.pl/charapp.txt";

if (@file_get_contents($avatarUrl)) {
    $file = "plr.CharacterAppearance = '{$avatarUrl}';";
} else {
    $file = "plr.CharacterAppearance = '{$defaultUrl}';";
}

  
    $headshot = '
        local baseHatZoom = 30
        local maxHatZoom = 100

        game:GetService("ContentProvider"):SetBaseUrl("http://eb2.ct8.pl/")
        game:GetService("ScriptContext").ScriptsDisabled = true

        local plr = game.Players:CreateLocalPlayer(1)
        ' . $file . '
        plr:LoadCharacter(false)

        local maxDimension = 0

        if plr.Character then
            for _, child in pairs(plr.Character:GetChildren()) do
                if child:IsA("Tool") then
                    child:Destroy()
                elseif child:IsA("Accoutrement") then
                    local size = child.Handle.Size / 2 + child.Handle.Position - plr.Character.Head.Position
                    local xy = Vector2.new(size.x, size.y)
                    if xy.magnitude > maxDimension then
                        maxDimension = xy.magnitude
                    end
                end
            end

            local maxHatOffset = 0.5
            maxDimension = math.min(1, maxDimension / 3)

            local viewOffset     = plr.Character.Head.CFrame * CFrame.new(0, 0 + maxHatOffset * maxDimension, 0.1)
            local positionOffset = plr.Character.Head.CFrame + (CFrame.Angles(0, -math.pi / 16, 0).lookVector.unit * 3)

            local camera = Instance.new("Camera", plr.Character)
            camera.Name = "ThumbnailCamera"
            camera.CameraType = Enum.CameraType.Scriptable
            camera.CoordinateFrame = CFrame.new(positionOffset.p, viewOffset.p)
            camera.FieldOfView = baseHatZoom + (maxHatZoom - baseHatZoom) * maxDimension
            workspace.CurrentCamera = camera
        end

        return game:GetService("ThumbnailGenerator"):Click("PNG", 1420, 1420, true)';


    $thumbnail = '
game:GetService("ContentProvider"):SetBaseUrl("http://eb2.ct8.pl/")
game:GetService("ScriptContext").ScriptsDisabled = true

local plr = game.Players:CreateLocalPlayer(1)
' . $file . '
plr:LoadCharacter(false)


return game:GetService("ThumbnailGenerator"):Click("PNG", 1420, 1420, true)';

    $render = $RCCServiceSoap->execScript($thumbnail, rand(1, getrandmax()), 120);
    $render2 = $RCCServiceSoap->execScript($headshot, rand(1, getrandmax()), 120);
    
    $avatarFilePath = '../Thumbs/Headshots/' . $username . '.png';
    file_put_contents($avatarFilePath, base64_decode($render2));
    
    $avatarFilePath2 = '../Thumbs/Avatars/' . $username . '.png';
    file_put_contents($avatarFilePath2, base64_decode($render));
  
    $logEntry = "[" . date("m/d/Y | H:i:s") . "] " .$_SESSION['username'] . " rendered themselves.";
    file_put_contents('../Admin/logs.txt', $logEntry . PHP_EOL, FILE_APPEND);
  
  header('Location: /');
  exit();

}  else {
    echo "Username is required.";
} 
?>
