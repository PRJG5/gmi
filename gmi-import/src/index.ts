import * as Fs from "fs";
import * as MySQL from "mysql";

interface ImportExcel {
	heading: string;
	heading_url: string;
	owner_id: string;
	language_iso: string;
	language_name: string;
	domain_content: string;
	subdomain_content: string;
	definition_content: string;
	definition_url: string;
	context_content: string;
	context_url: string;
	note_content: string;
	note_url: string;
}

const file: string = "./import.json";

const databaseSettings: object = {
	database: "gmi",
	host: "localhost",
	password: "gmi",
	port: 3306,
	user: "gmi",
};

const importedData: ImportExcel[] = JSON.parse(Fs.readFileSync(file, {encoding: "utf-8"}));

const databaseConnection = MySQL.createConnection(databaseSettings);
databaseConnection.connect();

importedData.forEach(async (card: ImportExcel): Promise<void> => {
	if (!(await languageExists(databaseConnection, card.language_iso))) {
		process.stdout.write(`${card.language_iso} existe pas\n`);
		await createLanguage(databaseConnection, card.language_iso, card.language_name, false);
	} else {
		process.stdout.write(`${card.language_iso} existe déjà\n`);
	}

	let domainId: number;
	if (!(await domainExists(databaseConnection, card.domain_content))) {
		domainId = await createDomain(databaseConnection, card.domain_content);
		process.stdout.write(`${card.domain_content} existe pas\n`);
	} else {
		domainId = await findDomain(databaseConnection, card.domain_content);
		process.stdout.write(`${card.domain_content} existe déjà\n`);
	}

	let subdomainId: number;
	if (!(await subdomainExists(databaseConnection, card.subdomain_content))) {
		subdomainId = await createSubdomain(databaseConnection, card.subdomain_content);
		process.stdout.write(`${card.subdomain_content} existe pas\n`);
	} else {
		subdomainId = await findSubdomain(databaseConnection, card.subdomain_content);
		process.stdout.write(`${card.subdomain_content} existe déjà\n`);
	}

	const definitionId: number = await createDefinition(databaseConnection, card.definition_content, card.definition_url);

	const contextId: number = await createContext(databaseConnection, card.context_content, card.context_url);

	const noteId: number = await createNote(databaseConnection, card.note_content, card.note_url);

	process.stdout.write(`domain: ${domainId}; subdomain: ${subdomainId}, definition: ${definitionId}, context: ${contextId}, note: ${noteId}\n\n`);

	Promise.resolve();
});

databaseConnection.end();

async function languageExists(database: MySQL.Connection, iso: string): Promise<boolean> {
	return new Promise<boolean>((resolve, reject): void => {
		database.query("SELECT count(*) as c FROM languages WHERE slug = ?", [
				iso,
			], (error, results: [{c: number}]): void => {
				if (error) {
					reject(error);
				}
				resolve(results[0].c > 0);
			},
		);
	});
}

async function createLanguage(database: MySQL.Connection, iso: string, name: string, sign: boolean): Promise<number> {
	return new Promise<number>((resolve, reject): void => {
		database.query("INSERT INTO languages (content, slug, isSigned) VALUES (?, ?, ?)", [
			name,
			iso,
			sign ? 1 : 0,
		], (error, results: {insertId: number}): void => {
			if (error) {
				reject(error);
			}
			resolve(results.insertId);
		});
	});
}

async function domainExists(database: MySQL.Connection, domain: string): Promise<boolean> {
	return new Promise<boolean>((resolve, reject): void => {
		database.query("SELECT count(*) as c FROM domains WHERE content = ?", [
				domain,
			], (error, results: [{c: number}]): void => {
				if (error) {
					reject(error);
				}
				resolve(results[0].c > 0);
			},
		);
	});
}

async function createDomain(database: MySQL.Connection, domain: string): Promise<number> {
	return new Promise<number>((resolve, reject): void => {
		database.query("INSERT INTO domains (content) VALUES (?)", [
			domain,
		], (error, result: {insertId: number}): void => {
			if (error) {
				reject(error);
			}
			resolve(result.insertId);
		});
	});
}

async function findDomain(database: MySQL.Connection, domain: string): Promise<number> {
	return new Promise<number>((resolve, reject): void => {
		database.query("SELECT id FROM domains WHERE content = ?", [
			domain,
		], (error, result: [{id: number}]): void => {
			if (error) {
				reject(error);
			}
			resolve(result[0].id);
		});
	});
}

async function subdomainExists(database: MySQL.Connection, subdomain: string): Promise<boolean> {
	return new Promise<boolean>((resolve, reject): void => {
		database.query("SELECT count(*) as c FROM subdomains WHERE content = ?", [
				subdomain,
			], (error, results: [{c: number}]): void => {
				if (error) {
					reject(error);
				}
				resolve(results[0].c > 0);
			},
		);
	});
}

async function createSubdomain(database: MySQL.Connection, subdomain: string): Promise<number> {
	return new Promise<number>((resolve, reject): void => {
		database.query("INSERT INTO subdomains (content) VALUES (?)", [
				subdomain,
			], (error, result: {insertId: number}): void => {
				if (error) {
					reject(error);
				}
				resolve(result.insertId);
			},
		);
	});
}

async function findSubdomain(database: MySQL.Connection, subdomain: string): Promise<number> {
	return new Promise<number>((resolve, reject): void => {
		database.query("SELECT id FROM subdomains WHERE content = ?", [
			subdomain,
		], (error, result: [{id: number}]): void => {
			if (error) {
				reject(error);
			}
			resolve(result[0].id);
		});
	});
}

async function createDefinition(database: MySQL.Connection, definition: string, link: string): Promise<number> {
	return new Promise<number>((resolve, reject): void => {
		database.query("INSERT INTO definitions (definition_content) VALUES (?)", [
				definition,
			], (error, result: {insertId: number}): void => {
				if (error) {
					reject(error);
				}
				resolve(result.insertId);
			},
		);
	});
}

async function createContext(database: MySQL.Connection, context: string, link: string): Promise<number> {
	return new Promise<number>((resolve, reject): void => {
		database.query("INSERT INTO contexts (context_to_string, url) VALUES (?, ?)", [
				context,
				link,
			], (error, result: {insertId: number}): void => {
				if (error) {
					reject(error);
				}
				resolve(result.insertId);
			},
		);
	});
}

async function createNote(database: MySQL.Connection, note: string, link: string): Promise<number> {
	return new Promise<number>((resolve, reject): void => {
		database.query("INSERT INTO notes (description, url) VALUES (?, ?)", [
				note,
				link,
			], (error, result: {insertId: number}): void => {
				if (error) {
					reject(error);
				}
				resolve(result.insertId);
			},
		);
	});
}

async function createCard(database: MySQL.Connection, heading: string, ownerId: number, languageId: string, domainId: number, subdomainId: number, contextId: number, definitionId: number, noteId: number, headinURL: string): Promise<void> {
	return new Promise<void>((resolve, reject): void => {
		database.query("INSERT INTO cards (heading, owner_id, language_id, domain_id, subdomain_id, context_id, definition_id, note_id, headingURL) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", [
			heading,
			ownerId,
			languageId,
			domainId,
			subdomainId,
			contextId,
			definitionId,
			noteId,
			headinURL,
		], (error, results: void): void => {
			if (error) {
				reject(error);
			}
			resolve();
		});
	});
}
