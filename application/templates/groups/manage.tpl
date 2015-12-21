            <div class="contentHeader">Manage Groups</div>
            <div class="contentBody">
                <div class="contentBody-sideMenu">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/profiles/" >View profiles</a></li>
                        <li><a href="/groups/">View Groups</a></li>
                    </ul>
                    <ul class="subMenu">
                        <li><a class="active">Manage Groups</a></li>
                        <li><a href="/groups/manage/new">Add Group</a></li>
                    </ul>
                </div>
                <div class="contentBody-main-container">
                    <div class="contentBody-main">
                        <div class="contentBody-main-header">
                            Manage Groups
                        </div>
                        <!-- -->
                        <div class="contentBody-main-body">
                            <p>Using groups you can gather multiple accounts that are to be compared to each other, based on for example industry. Create a new group in the menu to the left. Click on a group's name in the table below to change it.</p>
                            <p>
                                Add accounts to a group by pressing the icon the far right.
                            </p>
                            <table class="data-summary">
                                <thead>
                                    <tr>
                                        <th class="alphanumeric">Group</th>
                                        <th class="numeric">Accounts</th>
                                        <th class="numeric">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if (isset($groups)) {
                                        foreach($groups as $group) {
                                ?>
                                    <tr>
                                        <td class="alphanumeric">
                                            <input type="text" class="textField blue-glow-field autosave-input" data-id="<?=$group['id']?>" data-value="<?=$group['name']?>" value="<?=$group['name']?>" />
                                        </td>
                                        <td class="numeric">
                                            <?=$group["count"]?>
                                        </td>
                                        <td class="numeric">
                                            <img src="/public/images/delete.png" style="height:18px;">
                                        </td>
                                    </tr>
                                <?php
                                        }
                                    } else {
                                ?>
                                <!--- TODO: Show something when nothing is showing --->
                                <?php
                                    }
                                ?>
                                </tbody>
                            </table>


                        </div>
                        <!-- -->
                    </div>
                </div>
            </div>
