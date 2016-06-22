module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt);

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    sass: {
      dist: {
        files: [
          {
            src: ['Assets/css/core.sass'],
            dest: 'Assets/css/core.css'
          }
        ]
      }
    },

    concat: {
      css: {
          src: 'Assets/css/Uncompressed/*.sass',

          dest: 'Assets/css/core.sass'
      },

      js: {
          src: ['Assets/js/Uncompressed/*.js'],
          dest: 'Assets/js/core.js'
      }
    },

    watch: {
      css: {
        files: 'Assets/css/Uncompressed/*.sass',
        tasks: ['concat:css', 'sass']
      },

      js: {
        files: 'Assets/js/Uncompressed/*.js',
        tasks: ['concat:js']
      },
    }

  });

  grunt.registerTask('default', ['watch']);
  grunt.registerTask('wakeup', ['concat:css', 'sass', 'concat:js', 'watch']);
  grunt.registerTask('css', ['concat:css', 'sass']);
  grunt.registerTask('js', ['concat:js']);

}
