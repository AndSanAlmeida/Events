"use strict";

/** Helper class for Errors **/

class User {
    constructor() {
        this.id = "";
        this.first_name = "";
        this.last_name = "";
        this.email = "";
        this.type = 0;
        this.avatar = "empty.png";
        this.access_token = "";
    }

    set(field, value) {
        this[field] = value;
    }

    get(field) {
        if (this[field]) {
            return this[field];
        }
    }

    parse(auth_user) {
        this.id = auth_user.id;
        this.first_name = auth_user.first_name;
        this.last_name = auth_user.last_name;
        this.email = auth_user.email;
        this.type = auth_user.type;
        this.avatar = auth_user.avatar;
    }

    logged() {
        return this.access_token != "" ? true : false;
    }
}

module.exports = User;
