// SPDX-License-Identifier: GPL-3.0

pragma solidity ^0.8.6;
 
contract Callvalue {

    mapping (address => uint256) balances;

    constructor() payable {
        balances[msg.sender] = msg.value;
    }

    receive() external payable {
        balances[msg.sender] += msg.value;
    }

    fallback() external payable  {}

    function balanceOf(address account) public view returns (uint256) {
        return balances[account];
    }

    function transfer(address _recipient) public payable returns (bool) {
        balances[msg.sender] -= msg.value;
        balances[_recipient] += msg.value;
        return true;
    }
}
