export default class Gate {
	constructor(user) {
		this.user = user;
	}

	isAdmin() {
		return this.user.type === 'admin';
	}

	isGuru() {
		return this.user.type === 'guru';
	}
	
}