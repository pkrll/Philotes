            <div class="contentHeader">View Groups</div>
            <div class="contentBody">
                <div class="contentBody-sideMenu">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/profiles/" >View profiles</a></li>
                        <li><a class="active">View Groups</a></li>
                    </ul>
                    <ul class="subMenu">
                        <li><a href="/groups/add">Add Group</a></li>
                        <li><a href="/groups/manage">Manage Groups</a></li>
                    </ul>
                </div>
                <div class="contentBody-main-container">
                    <div class="contentBody-main">
                        <div class="contentBody-main-header">
                            All Groups
                        </div>
                        <!-- -->
                        <div class="contentBody-main-body">
                        <?php
                            if (isset($groups) AND empty($groups) == FALSE) {
                                foreach ($groups as $key => $value) {
                        ?>
                            <!-- -->
                            <div class="group-container">
                                <div>
                                    <img src="/public/images/group.png">
                                    <div>
                                        <div><?=$value["name"]?></div>
                                        <div>Inl&auml;gg: 0.</div>
                                        <div>F&ouml;ljare: 0.</div>
                                    </div>
                                </div>
                            </div>
                            <!-- --->
                        <?php
                                }
                            } else {
                        ?>
                            <div style="width:300px; margin: auto">
                                <div>
                                    No groups found. Create a new group by selecting <b>Add group</b> in the menu to the left.
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                        </div>
                        <!-- -->
                    </div>
                </div>
            </div>
