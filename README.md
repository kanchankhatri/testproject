Functionalities : user login logout<br>
user can change its profile info.<br>
restful apis for login, logout, auth_status, edit_profile, get_user_profile.<br>
APIs:<br>
auth key is X-API-KEY=testauthapp123<br>
whether user id logged in or not:  /api/info/auth_status GET userid<br>
logout: /api/info/logout?userid=5 GET userid<br>
login: api/info/login POST email,password<br>
userinfo: /api/info/users GET userid=7,format:json<br>
user edit profile: /api/info/user POST userid,full_name,email.<br>
