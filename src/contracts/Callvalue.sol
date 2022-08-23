// SPDX-License-Identifier: GPL-3.0

pragma solidity ^0.8.6;
 
contract Callvalue {

    mapping (address => uint256) balances;
    event Transfer(address indexed _sender, address indexed _recipient, uint256 _value);
    event Received(address indexed _sender, uint256 _value);

    address public beneficiary;

    constructor() payable {
        beneficiary = msg.sender;
        balances[msg.sender] = msg.value;

        emit Received(msg.sender, msg.value);
    }
 
    receive() external payable {
        balances[msg.sender] += msg.value;
        transfer(beneficiary);
 
        emit Received(msg.sender, msg.value);
    }
 
    fallback() external payable  {}

    function transfer(address _recipient) public payable returns (bool) {
        require(_recipient != address(0), "Require: Address");
        require(msg.value <= balances[msg.sender], "Require: Balance transfer");
 
        balances[msg.sender] -= msg.value;
        balances[_recipient] += msg.value;
 
        emit Transfer(msg.sender, _recipient, msg.value);
        emit Transfer(msg.sender, _recipient, msg.value);
       
        return true;
    }

    function balanceOf(address account) public view returns (uint256) {
        return balances[account];
    }
}
