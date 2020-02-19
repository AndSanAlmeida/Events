"use strict";

/** Helper class for Errors **/

class User {
    constructor() {
        this.id = "";
        this.name = "";
        this.email = "";
        this.username = "";
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
        this.name = auth_user.name;
        this.email = auth_user.email;
        this.username = auth_user.username;
        this.type = auth_user.type;
        this.avatar = auth_user.avatar;
    }

    logged() {
        return this.access_token != "" ? true : false;
    }
}

module.exports = User;
