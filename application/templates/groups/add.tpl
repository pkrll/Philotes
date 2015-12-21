            <div class="contentHeader">Manage Groups</div>
            <div class="contentBody">
                <div class="contentBody-sideMenu">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/profiles/" >View profiles</a></li>
                        <li><a href="/groups/">View Groups</a></li>
                    </ul>
                    <ul class="subMenu">
                        <li><a href="/groups/manage">Manage Groups</a></li>
                        <li><a class="active">Add Group</a></li>
                    </ul>
                </div>
                <div class="contentBody-main-container">
                    <div class="contentBody-main">
                        <div class="contentBody-main-header">
                            Create Group
                        </div>
                        <!-- -->
                        <div class="contentBody-main-body">
                            <div class="form-container">
                                <form action="/groups/manage/" method="post">
                                    Name: <input type="text" placeholder="Name" name="name" class="blue-glow-field">
                                    <br/>
                                    Description: <input type="text" placeholder="Description" name="description" class="blue-glow-field">
                                    <br/>
                                    &nbsp;
                                    <input type="submit" value="Create">
                                </form>
                            </div>
                        </div>
                        <!-- -->
                    </div>
                </div>
            </div>
