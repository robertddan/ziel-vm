(async function(){

const ethers = require('ethers');
const path = require('path')
const fs = require('fs')
//const ziel = require('./ziel');


let sNetwork = 'goerli'; //homestead
let provider = new ethers.providers.InfuraProvider(sNetwork, "3e7f88ed3dc242c38332ecf58900a68e");
//let wallet = new ethers.Wallet(ziel.sZielPrivate1, provider);
/*
		31a24edad8548ae2ab963156c2ec15b8480fd66e4c3e39278e2247ed5c6ac035 
		0x02CC64973a38A82A446A9c4BF3C68c126ecF764d
		9c20c00af708be5f1870e138d48c96eaa54e5eea406194d9f1405bf3793c488f 
		0x23A14e97A59779165BF83310a712B84F101c9140
		99b3969b60796ddf89480448423420ee2cee807936867885909508b17d0e635a
		0x2DFe5B0D283B81AA88D77083C9FBA195B2eF3bA1
*/
let receiverAddress1 = "0x02CC64973a38A82A446A9c4BF3C68c126ecF764d";
let receiverAddress2 = "0x23A14e97A59779165BF83310a712B84F101c9140";
//let amountInEther = "0.001";

let gas_limit = '0x989680'; //5000000 //"0x100000" // Gas Limit & Usage by Txn: 5,000,000 | 21,000 (0.42%) 
let gas_price = '0xD09DC30E'; //250000000000 //22500000000 // fast-33 average-30 slow-22.5 // 0.0000001 Ether (100 Gwei) // gas calculator

/*
Value: 1 wei ($0.00)
Transaction Fee: 0.0021 Ether ($0.00)
Gas Price: 0.0000001 Ether (100 Gwei)
Gas Limit & Usage by Txn: 5,000,000 | 21,000 (0.42%)
Gas Fees: Base: 0.104296913 Gwei |Max: 100 Gwei |Max Priority: 100 Gwei
Burnt & Txn Savings Fees: 🔥 Burnt: 0.000002190235173 Ether ($0.00) 💸 Txn Savings: 0 Ether ($0.00)
*/
/*
const sGasPrice = await provider.getGasPrice().then((currentGasPrice) => {
	//console.log(BigNumber.toString(currentGasPrice));
	let gas_price = ethers.utils.hexlify(parseInt(currentGasPrice))
	console.log(`gas_price: ${gas_price}`)
});
return console.log('##');
*/
	
let txFromAddress = receiverAddress1;
let txToAddress = receiverAddress2;
let private_key = "31a24edad8548ae2ab963156c2ec15b8480fd66e4c3e39278e2247ed5c6ac035";

let wallet = new ethers.Wallet(private_key);
let walletSigner = wallet.connect(provider);

/*
https://docs.ethers.io/v5/api/utils/transactions/
*/
const tx = {
	from: txFromAddress,
	//to: txToAddress,
	value: 1, //ethers.utils.parseEther(send_token_amount),
	nonce: provider.getTransactionCount(
		txFromAddress,
		"latest"
	),
	gasLimit: ethers.utils.hexlify(gas_limit),
	gasPrice: gas_price,
	data: '0x600060006009f0'
}
console.dir(tx)


	
try {
	walletSigner.sendTransaction(tx)
	.then(async function(tx){
		console.log(tx);
		return tx;
	})
	.then(async function(tx){
		let response = await tx.wait();
		console.log(response);
	})
	.catch(async function(error){
		console.log(error);
	});
} catch (error) {
	console.log(error);
}
	
})()

