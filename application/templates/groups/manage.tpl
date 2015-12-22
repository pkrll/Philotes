            <link rel="stylesheet" property="stylesheet" href="/public/css/presentation.css">
            <link rel="stylesheet" property="stylesheet" href="/public/css/groups/form.css">
            <link rel="stylesheet" property="stylesheet" href="/public/css/form.css">
            <div class="header">Manage Groups</div>
            <div class="body">
                <div class="menu">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/profiles/" >View profiles</a></li>
                        <li><a href="/groups/">View Groups</a></li>
                    </ul>
                    <ul class="subMenu">
                        <li><a class="active">Manage Groups</a></li>
                        <li><a href="/groups/manage/new">Create Group</a></li>
                    </ul>
                </div>
                <div class="surface">
                    <div class="content">
                        <div class="header">
                            Manage Groups
                        </div>
                        <!-- -->
                        <div class="body">
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
                                            <input type="text" class="textField blueFocus autosave-input" data-id="<?=$group['id']?>" data-value="<?=$group['name']?>" value="<?=$group['name']?>" />
                                        </td>
                                        <td class="numeric">
                                            <?=$group["count"]?>
                                        </td>
                                        <td class="numeric">
                                            <img src="/public/images/delete.png" alt="" style="height:18px;">
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
            <script type="text/javascript" src="/public/javascript/groups.js"></script>
