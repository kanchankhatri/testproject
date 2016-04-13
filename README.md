Functionalities : user login logout<br>
user can change its profile info.
restful apis for login, logout, auth_status, edit_profile, get_user_profile.
APIs:
auth key is X-API-KEY=testauthapp123
whether user id logged in or not:  /api/info/auth_status GET userid
logout: /api/info/logout?userid=5 GET userid
login: api/info/login POST email,password
userinfo: /api/info/users GET userid=7,format:json
user edit profile: /api/info/user POST userid,full_name,email.
