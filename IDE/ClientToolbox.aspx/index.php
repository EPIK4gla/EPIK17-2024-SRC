<!DOCTYPE html>
<html lang="en">
<head><style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style><script type="text/javascript" async="" src="https://web.archive.org/web/20190612211751/https://ssl.google-analytics.com/ga.js"></script><script src="//archive.org/includes/analytics.js?v=cf34f82" type="text/javascript"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    
<link onerror="Roblox.BundleDetector &amp;&amp; Roblox.BundleDetector.reportBundleError(this)" rel="stylesheet" href="toolbox1.css">

</head>
  <body>
    
    <ul class="client-toolbox-assets" ng-show="isAssetsPageShown==true">
        
        <?php
        $toolboxItems = array(
            array('Bloxy Cola', 'https://tr.rbxcdn.com/3cd20aec82c0e661b3c9f345f3d3889c/420/420/Gear/Png', 10472779),
            array("Road", 'https://tr.rbxcdn.com/1637e4622d3acd3d529ae49ac5054363/250/250/Model/Png', 670058329),
            array("Classic House", 'https://tr.rbxcdn.com/b74ddd8ef09ad6e431d42c1c1b16365f/420/420/Model/Png', 8959904556),
            array('Drooling Zombie', 'https://tr.rbxcdn.com/c783cb49c534c3d77c1c052851ee6bad/420/420/Model/Png', 187789986)
        );

        foreach ($toolboxItems as $item) {
            ?>
            <li class="client-toolbox-item ng-scope" ng-repeat="asset in assets">
            <div class="client-toolbox-inner" data-asset="{&quot;Asset&quot;:{&quot;Id&quot;:185687363,&quot;Name&quot;:&quot;Observation Tower&quot;,&quot;TypeId&quot;:10,&quot;AssetGenres&quot;:[],&quot;IsEndorsed&quot;:true,&quot;Description&quot;:&quot;Observer the world, destroy the world, all in a good days work.&quot;,&quot;Created&quot;:&quot;11/6/2014 12:48:28 AM&quot;,&quot;Updated&quot;:&quot;6/14/2016 6:29:09 PM&quot;},&quot;Creator&quot;:{&quot;Id&quot;:4397833,&quot;Name&quot;:&quot;Quenty&quot;,&quot;Type&quot;:1},&quot;Thumbnail&quot;:{&quot;Final&quot;:true,&quot;Url&quot;:&quot;https://web.archive.org/web/20190612211751/https://t5.rbxcdn.com/75f38d7f7f3fb327b056421bc5b610f1&quot;,&quot;RetryUrl&quot;:null,&quot;UserId&quot;:0,&quot;EndpointType&quot;:&quot;Avatar&quot;},&quot;Voting&quot;:{&quot;ShowVotes&quot;:true,&quot;UpVotes&quot;:7703,&quot;DownVotes&quot;:983,&quot;CanVote&quot;:false,&quot;UserVote&quot;:null,&quot;HasVoted&quot;:false,&quot;ReasonForNotVoteable&quot;:&quot;InvalidAssetOrUser&quot;}}">
                <div draggable="true" data-asset-index="0" title="<?php echo $item[0]; ?>" ng-click="insertAsset()" roblox-toolbox-thumbnail="" asset="asset" index="0" insert-asset="insertAsset()" ondragstart="dragRBX(<?php echo $item[2]; ?>)" class="client-toolbox-image ng-isolate-scope">
                    <img onclick="insertContent(<?php echo $item[2]; ?>)" ng-src="" ng-class="{'client-toolbox-bg-checkered':imageBackground=='None','client-toolbox-bg-white':imageBackground=='White','client-toolbox-bg-black':imageBackground=='Black'}" class="client-toolbox-asset-img client-toolbox-img-bg client-toolbox-bg-white" alt="<?php echo $item[0]; ?>" src="<?php echo $item[1]; ?>">
                    <!-- ngIf: asset.Asset.IsEndorsed==true -->
                    <div ng-class="{'client-toolbox-stamp':asset.Asset.TypeId!=3,'client-toolbox-stamp-audio':asset.Asset.TypeId==3}" ng-if="asset.Asset.IsEndorsed==true" title="Marked as a high-quality item" class="ng-scope client-toolbox-stamp"></div>
                    <!-- end ngIf: asset.Asset.IsEndorsed==true -->
                    <span class="client-toolbox-asset-name ng-binding"><?php echo $item[0]; ?></span>
                    <!-- ngIf: asset.Asset.TypeId==3 -->
                </div>
                <div class="client-toolbox-voting ng-hide" ng-show="asset.Voting.HasVoted||selectedIds.indexOf(asset.Asset.Id)>-1">
                    <span class="client-toolbox-vote client-toolbox-upvote" ng-class="{'client-toolbox-vote-selected':asset.Voting.UserVote==true}" ng-click="handleVote(true)"></span>
                    <span class="client-toolbox-vote client-toolbox-downvote" ng-class="{'client-toolbox-vote-selected':asset.Voting.UserVote==false}" ng-click="handleVote(false)"></span>
                </div>
                <p class="client-toolbox-creator" ng-click="searchByCreator()" title="lvtkr">by <span class="client-toolbox-creator-name ng-binding">lvtkr</span>
                </p>
                <!-- ngIf: asset.Voting.ShowVotes==true&&asset.Voting.UpVotes+asset.Voting.DownVotes>0 -->
                <span ng-if="asset.Voting.ShowVotes==true&amp;&amp;asset.Voting.UpVotes+asset.Voting.DownVotes>0" ng-hide="asset.Voting.HasVoted||selectedIds.indexOf(asset.Asset.Id)>-1" class="client-toolbox-vote-container ng-scope">
                    <div class="client-toolbox-progress">
                        <span class="client-toolbox-bar" style="width:0%"></span>
                    </div>
                    <!-- ngIf: asset.Voting.UpVotes+asset.Voting.DownVotes>1 -->
                    <span ng-if="asset.Voting.UpVotes+asset.Voting.DownVotes>1" class="ng-binding ng-scope">0 votes</span>
                    <!-- end ngIf: asset.Voting.UpVotes+asset.Voting.DownVotes>1 -->
                    <!-- ngIf: asset.Voting.UpVotes+asset.Voting.DownVotes==1 -->
                </span>
                <!-- end ngIf: asset.Voting.ShowVotes==true&&asset.Voting.UpVotes+asset.Voting.DownVotes>0 -->
            </div>
        </li>
            <?php
        }
        ?>
    </ul>
    

  
    
  <script>
        function insertContent(id) {
            try {
                window.external.Insert("http://eb2.ct8.pl/asset/?id=" + id);
            } catch (x) {
                alert("Sorry, Unable to insert item.");
            }
        }

        function dragRBX(id) {
            try {
                window.external.StartDrag("http://eb2.ct8.pl/asset/?id=" + id);
            } catch (x) {
                alert("Sorry, Unable to drag item.");
            }
        }

        function clickButton(e, buttonid) {
            var bt = document.getElementById(buttonid);
            if (typeof bt == 'object') {
                if (navigator.appName.indexOf("Netscape") > (-1)) {
                    if (e.keyCode == 13) {
                        bt.click();
                        return false;
                    }
                }
                if (navigator.appName.indexOf("Microsoft Internet Explorer") > (-1)) {
                    if (event.keyCode == 13) {
                        bt.click();
                        return false;
                    }
                }
            }
        }
    </script>

</body>
</html>