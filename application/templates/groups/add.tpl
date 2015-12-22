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
                        <li><a href="/groups/manage">Manage Groups</a></li>
                        <li><a class="active">Create Group</a></li>
                    </ul>
                </div>
                <div class="surface">
                    <div class="content">
                        <div class="header">
                            Create Group
                        </div>
                        <!-- -->
                        <div class="body">
                            <div class="formContainer">
                                <form action="/groups/manage/new" method="post">
                                    Name: <input type="text" placeholder="Name" name="name" class="blueFocus">
                                    <br/>
                                    Description: <input type="text" placeholder="Description" name="description" class="blueFocus">
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
