module.exports = function( grunt ) {
    'use strict';

    // Load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    // Project configuration
    grunt.initConfig( {
        pkg:    grunt.file.readJSON( 'package.json' ),

        compass: {
            dist: {
                options: {
                    sassDir: 'sass',
                    cssDir: 'css',
                    imagesDir: 'css/img',
                    outputStyle: 'compact'
                }
            }
        },

        jshint: {
            options: {
                onecase: false
            },
            all: ['js/libs/main.js']
        },

        concat: {
            // options: {
              // separator: ';',
            // },
            dist: {
                src: [ 'js/main.js' ],
                dest: 'js/all.js'
            }
        },

        // uglify: {
        //     all: {
        //         files: {
        //             'js/all-min.js': ['js/all.js']
        //         },
        //         options: {
        //             banner: '/*! <%= pkg.title %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %>\n' +
        //                 ' * <%= pkg.homepage %>\n' +
        //                 ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
        //                 ' * Licensed GPLv2+' +
        //                 ' */\n',
        //             mangle: {
        //                 except: ['jQuery']
        //             }
        //         }
        //     }
        // },

        // imagemin: {
        //     static: {
        //         options: {
        //             optimizationLevel: 3
        //         },
        //     },
        //     dynamic: {
        //         files: [{
        //             expand: true,
        //             cwd: 'css/img-2014/',
        //             src: ['*.{png,jpg,gif}'],
        //             dest: 'css/img-2014/compressed/'
        //         }]
        //     }
        // },

        watch:  {

            scripts: {
                files: ['js/*.js'],
                tasks: ['jshint', 'concat'],
                options: {
                    debounceDelay: 200
                }
            },

            css: {
                files: ['sass/*.scss'],
                tasks: ['compass'],
            },

            livereload: {
                options: { livereload: true },
                files: ['css/*'],
            },

        }

    } );

    // Default task.
    grunt.registerTask( 'default', ['jshint', 'compass', 'uglify', 'concat', 'watch'] );

    grunt.util.linefeed = '\n';
};
