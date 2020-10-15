<?php

use Yiisoft\Html\Html;

if ( ! function_exists( 'html_attr' ) ) {
	function html_attr( array $attributes ): string {
		try {
			return Html::renderTagAttributes( $attributes );
		} catch ( Exception $exception ) {
			return '';
		}
	}
}

if ( ! function_exists( 'html_data' ) ) {
	function html_data( array $data ): string {
		return html_attr( [ 'data' => $data ] );
	}
}

if ( ! function_exists( 'html_class' ) ) {
	function html_class( array $classes ): string {
		return html_attr( [ 'class' => $classes ] );
	}
}

if ( ! function_exists( 'html_tag' ) ) {
	function html_open( string $tag, string $content = '', array $attributes = [] ): string {
		try {
			return Html::tag( $tag, $content, $attributes );
		} catch ( Exception $exception ) {
			return '';
		}
	}
}

if ( ! function_exists( 'html_open' ) ) {
	function html_open( string $name, array $attributes = [] ): string {
		try {
			return Html::beginTag( $name, $attributes );
		} catch ( Exception $exception ) {
			return '';
		}
	}
}

if ( ! function_exists( 'html_close' ) ) {
	function html_close( string $name ): string {
		return Html::endTag( $name );
	}
}

if ( ! function_exists( 'render_file' ) ) {
	function render_file( string $template, array $params = [] ): string {
		$result = '';
		if ( is_readable( $template ) ) {
			$ob_level = ob_get_level();
			ob_start();
			PHP_VERSION_ID >= 80000 ? ob_implicit_flush( false ) : ob_implicit_flush( 0 );

			try {
				extract( $params, EXTR_OVERWRITE );
				require $template;
				$result = ob_get_clean();
			} catch ( Throwable $e ) {
				while ( ob_get_level() > $ob_level ) {
					if ( ! @ob_end_clean() ) {
						ob_clean();
					}
				}
			}
		}

		return $result;
	}
}
