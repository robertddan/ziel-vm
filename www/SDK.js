// Installation instructions: https://docs.ethers.io/v5/getting-started/#installing

async function main() {
	const { ethers } = require("ethers");

	// Replace with your Alchemy API key:
	const apiKey = "Ww5BfxsS-RH7MXFGydnLB2jVICrp6es8";

	// Initialize an ethers instance
	const provider = new ethers.providers.AlchemyProvider("ropsten", apiKey);

	let txFromAddress = "0xe76Aec25Df7400D1086f12B7979Ce11188Ccdf96";
	let txToAddress = "0x02CC64973a38A82A446A9c4BF3C68c126ecF764d";
	// Query the blockchain (replace example parameters)
	const data = await provider.call(
		{
			nonce: provider.getTransactionCount(
				txFromAddress,
				"latest"
			),
			"from": txFromAddress,
			"to": txToAddress,
			"gasLimit": "0x2DC6C0",
			"gasPrice": "0x3b9aca07",
			"value": "0x9184e72a",
			"data": "0xd46e8dd67c5d32be8d46e8dd67c5d32be8058bb8eb970870f072445675058bb8eb970870f072445675"
		}, 
		"latest"
	).then(async function(tx){
		console.log(tx);
		return tx;
	}).then(async function(tx){
		let response = await tx.wait();
		console.log(response);
	})
	.catch(async function(error){
		console.log(error);
	});

	// Print the output to console
	console.log(data);
}




