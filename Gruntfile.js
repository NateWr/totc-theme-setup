'use strict';

module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({

		// Load grunt project configuration
		pkg: grunt.file.readJSON('package.json'),

		// Configure JSHint
		jshint: {
			test: {
				src: [
					'src/assets/js/*.js',
				]
			}
		},

		// Concatenate scripts
		concat: {
			build: {
				files: {
					'dist/assets/js/theme-setup.js': [
						'src/assets/js/theme-setup.js'
					]
				}
			}
		},

		// Watch for changes on some files and auto-compile them
		watch: {
			build: {
				files: [
					'**',
					'!node_modules/**',
					'!Gruntfile.js',
					'!package.json',
					'!.git/**',
					'!.gitignore',
					'!dist/**',
					'!.*', // hidden files
					'!**/*~' // hidden files
				],
				tasks: ['build']
			}
		},

		// Copy files to build directory
		copy: {
			build: {
				expand: true,
				cwd: 'src/',
				src: [
					'**',
					'!assets/js/*.js',
					'!assets/js/components/**',
					'!.*', // hidden files
					'!**/*~' // hidden files
				],
				dest: 'dist/'
			},
			readme: {
				src: [
					'license.md',
					'readme.md'
				],
				dest: 'dist/'
			}
		},

		// Clean up the build directory
		clean: {
			build: ['dist/**']
		}

	});

	// Load tasks
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-nodeunit');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');

	// Default task(s).
	grunt.registerTask('default', ['watch:build']);
	grunt.registerTask('build', ['jshint', 'clean', 'concat', 'copy'] );

};
