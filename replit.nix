{ pkgs }: {
	deps = [
		pkgs.sudo
  pkgs.assh
  pkgs.solc
  pkgs.nodejs-16_x
  pkgs.php80Packages.composer
  pkgs.php74
	];
}